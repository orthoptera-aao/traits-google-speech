<?php
include("modules/traits-googlespeech/googlespeech/speech-async.php");
include("modules/traits-googlespeech/googlespeech/config/languages.php");

function googlespeech_info() {
  return(
    array(
      "googlespeech" => array(
        "dependencies" => array("bioacoustica", "flac") //BioAcoustica provides wave file.
      )
    )
  );
}

function googlespeech_init() {
  $init = array(
    "gsutil" => array(
      "type" => "cmd",
      "required" => "required",
      "missing text" => "googlespeech requires gsutil",
      "version flag" => "version"
    )
  );
  return ($init);
}

function googlespeech_prepare() {
  global $system;
  core_log("info", "googlespeech", "Attempting to list googlespeech files on analysis server.");
  exec("s3cmd ls s3://bioacoustica-analysis/googlespeech/", $output, $return_value);
  if ($return_value == 0) {
    if (count($output) == 0) {
      $system["analyses"]["googlespeech"] = array();
    } else {
      foreach ($output as $line) {
        $start = strrpos($line, "/");
        $system["analyses"]["googlespeech"][] = substr($line, $start + 1);
      }
    }
  core_log("info", "googlespeech", count($system["analyses"]["googlespeech"])." googlespeech files found.");
  }
  return(array());
}

function googlespeech_analyse($recording) {
  global $system;
  $return = array();
  foreach ($system["googlespeech"]["languages"] as $language) {
    if (!in_array($recording["id"].".".$language.".txt", $system["analyses"]["googlespeech"])) {
      $file = core_download("flac/".$recording["id"].".44k.30min.flac");
      if ($file == NULL) {
        core_log("warning", "googlespeech",  "File was not available, skipping analysis.");
        return($return); //TODO: continue;
      }
      $return[$recording["id"].".wav"] = array(
        "file name" => $recording["id"].".44k.30min.flac",
        "local path" => "scratch/flac/",
        "save path" => NULL
      );
      core_log("info", "googlespeech", "Attempting analysis of $language for recording ".$recording["id"].".");
      core_log("info", "googlespeech", "Upload file to Google Cloud.");
      exec("gsutil cp scratch/flac/".$recording["id"].".44k.30min.flac gs://bioacoustica-speech", $output, $return_value);
      if ($return_value == 0) {
        $results = transcribe_async_gcs('bioacoustica-speech', $recording["id"].".44k.30min.flac", $language);
        file_put_contents("modules/traits-googlespeech/googlespeech/".$recording["id"].".".$language.".txt", serialize($results));
        $return[$recording["id"].$language.".txt"] = array(
          "file name" => $recording["id"].".".$language.".txt",
          "local path" => "modules/traits-googlespeech/googlespeech/",
          "save path" => "googlespeech/"
        );
          exec("gsutil rm gs://bioacoustica-speech/".$recording["id"].".44k.30min.flac");
      } else {
        core_log("warning", "googlespeech", "Could not upload to Google Cloud: ".serialize($output));
      }
    }
    if (!in_array($recording["id"].".".$language.".txt.words.sections", $system["analyses"]["googlespeech"])) {
      $file = core_download("googlespeech/".$recording["id"].".".$language.".txt");
      if ($file == NULL) {
       core_log("warning", "googlespecch",  $recording["id"].".".$language.".txt is unavailable.");
      } else {
        $return[$recording["id"].$language.".txt"] = array(
          "file name" => $recording["id"].".".$language.".txt",
          "local path" => "scratch/googlespeech/",
          "save path" => NULL
        );
        
        $json_string = file_get_contents("scratch/googlespeech/".$recording["id"].".".$language.".txt");
        $json = unserialize($json_string);
        $fp = fopen("scratch/googlespeech/".$recording["id"].".".$language.".txt.words", "w");
        foreach ($json as $result) {
          $alternative = $result->alternatives()[0];
          foreach ($alternative['words'] as $wordInfo) {
            if ($wordInfo['startTime'] == '') {
              continue;
            } 
            fputcsv($fp, array($wordInfo['startTime'], $wordInfo['endTime'], $wordInfo['word']));
          }
        }
        fclose($fp);
        $return[$recording["id"].$language.".txt.words"] = array(
          "file name" => $recording["id"].".".$language.".txt.words",
          "local path" => "scratch/googlespeech/",
          "save path" => "googlespeech/"
        );
        
        //Sections
        $words= array();
        $fp = fopen("scratch/googlespeech/".$recording["id"].".".$language.".txt.words", "w");
        while ($row = fgetcsv($fp)) {
          $row[0] = filter_var($row[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          $row[1] = filter_var($row[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          $words[] = $row;
        }
        fclose($fp);

        if (count($words)==0) {
          //continue; 
        }

        $sections = array();

        $block_start = NULL;
        $previous_time = NULL;
        $word_count = count($words);
        $position = 1;

        foreach($words as $word) {
          if ($block_start == NULL) {
            $block_start = $word[0];
          }
          if ($previous_time == NULL) {
            $previous_time = $word[1];
          }
          if ($previous_time + 1 >= $word[0]) {
            $previous_time = $word[1];
          } else {
            $sections[] = array($block_start, $previous_time);
            $block_start = NULL;
            $previous_time = NULL;
          }
          if ($position == $word_count) {
            $sections[] =  array($block_start, $word[1]);
          }
          $position++;
        }
        $fq = fopen("scratch/googlespeech/".$recording["id"].".".$language.".txt.words.sections", "w");
        foreach ($sections as $section) {
          fputcsv($fq, $section);
          fputcsv($fa, $section);
        }
        fclose($fq);
        $return[$recording["id"].$language.".txt.words.sections"] = array(
          "file name" => $recording["id"].".".$language.".txt.words.sections",
          "local path" => "scratch/googlespeech/",
          "save path" => "googlespeech/"
        );
      }
    }
  }
return($return);
}
