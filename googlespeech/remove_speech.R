library(tuneR)
library(seewave)
library(data.table)

args = commandArgs(trailingOnly=TRUE)
recording_id <- args[1]

wave <- readWave(paste0("scratch/wav/",recording_id,".wav"));

tryCatch({
  speech <- fread(paste0("scratch/googlespeech/",recording_id,".txt.words.sections"))
  speech_buffer <- 2; #seconds before and after
  
  speech$V1 <- speech$V1 - speech_buffer
  speech$V1[which(speech$V1 < 0)] <- 0
  
  speech$V2 <- speech$V2 + speech_buffer
  speech$V1[which(speech$V2 > duration(wave))] <- duration(wave)
  
  f <- wave@samp.rate
  for (i in 1:length(speech$V1)) {
    
    wave_1 <- pastew(
      silence(samp.rate=f, duration=speech$V2[i]-speech$V1[i], xunit="time"),
      cutw(wave, from=0, to=speech$V1[i], output="Wave"),
      f=f,
      output="Wave"
    )
    wave <- pastew(
      cutw(wave, from=speech$V2[i], to=duration(wave), output="Wave"),
      wave_1,
      f=f,
      output="Wave"
    )
  }
}, error = function(err) {
  print("No speech profile")
  print(err)
})

savewav(wave, filename=paste0("scratch/googlespeech/",recording_id,".speech_removed.wav"))
