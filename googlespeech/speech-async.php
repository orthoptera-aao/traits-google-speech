<?php

require_once "vendor/autoload.php";
use Google\Cloud\Speech\SpeechClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\ExponentialBackoff;

/**
 * Transcribe an audio file using Google Cloud Speech API
 * Example:
 * ```
 * transcribe_async_gcs('your-bucket-name', 'audiofile.wav');
 * ```.
 *
 * @param string $bucketName The Cloud Storage bucket name.
 * @param string $objectName The Cloud Storage object name.
 * @param string $languageCode The Cloud Storage
 *     be recognized. Accepts BCP-47 (e.g., `"en-US"`, `"es-ES"`).
 * @param array $options configuration options.
 *
 * @return string the text transcription
 */
function transcribe_async_gcs($bucketName, $objectName, $languageCode = 'en-US', $options = [])
{
    // Create the speech client
    $speech = new SpeechClient([
        'languageCode' => $languageCode,
    ]);


    $options['enableWordTimeOffsets'] = true;

    // Fetch the storage object
    $storage = new StorageClient();
    $object = $storage->bucket($bucketName)->object($objectName);

    // Create the asyncronous recognize operation
    $operation = $speech->beginRecognizeOperation(
        $object,
        $options
    );

    // Wait for the operation to complete
    $backoff = new ExponentialBackoff(100);
    $backoff->execute(function () use ($operation) {
        print('Waiting for operation to complete' . PHP_EOL);
        $operation->reload();
        if (!$operation->isComplete()) {
            throw new Exception('Job has not yet completed', 500);
        }
    });

    // Print the results
    if ($operation->isComplete()) {
        $results = $operation->results();
        return($results);
        foreach ($results as $result) {
            $alternative = $result->alternatives()[0];
            printf('Transcript: %s' . PHP_EOL, $alternative['transcript']);
            printf('Confidence: %s' . PHP_EOL, $alternative['confidence']);
            foreach ($alternative['words'] as $wordInfo) {
                printf('  Word: %s (start: %s, end: %s)' . PHP_EOL,
                    $wordInfo['word'],
                    $wordInfo['startTime'],
                    $wordInfo['endTime']);
            }

        }
    }
}
