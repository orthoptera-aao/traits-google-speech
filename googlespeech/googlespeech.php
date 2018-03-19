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
        return($return);
      }
      $return[$recording["id"].".wav"] = array(
        "file name" => $recording["id"].".44k.30min.flac",
        "local path" => "scratch/flac/",
        "save path" => NULL
      );
      core_log("info", "googlespeech", "Attempting analysis of $language for recording ".$recording["id"].".");
      core_log("info", "googlespeech", "Upload file to Google Cloud.");
      exec("gsutil cp scratch/flac/".$recording["id"].".44k.30min.flac gs://bioacoustica-speech", $output, $return_value);
      if ($return == 0) {
        $results = transcribe_async_gcs('bioacoustica-speech', $recording["id"].".44k.30min.flac", $language);
        file_put_contents($recording["id"].".".$language.".txt", serialize($results));
        $return[$recording["id"].$lang.".txt"] = array(
          "file name" => $recording["id"].".".$language.".txt",
          "local path" => "modules/googlespeech/",
          "save path" => "googlespeech"
        );
          exec("gsutil rm gs://bioacoustica-speech/".$recording["id"].".44k.30min.flac");
      } else {
        core_log("warning", "googlespeech", "Could not upload to Google Cloud: ".serialize($output));
      }
    }
  }
  
  
  return($return);
}
