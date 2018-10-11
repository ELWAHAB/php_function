x <- c( 21,10,14,20,18,15,17,17,21,20,11,19,19,12,13,
        23,12,11,20,13,15,14,15,14,16,17,12,22,15,11,
        22,23,13,11,12,15,19,19,21,20,20,12,14,12,16,
        14,11,19,19,11,13,13,14,16,14,17,19,18,10,12,
        24,16,17,18,19,18,15,19,10,20,20,13,20,12,18)

xSort <- sort(x)
#oneX <- matrix(  )
number <- vector()
numberFrequency <- vector()
indexX <- 1
for (i in 1:length(xSort)) {
  if(length(which(xSort[i] == number )) != 1 ){
    number[indexX] <- xSort[i]
    numberFrequency[indexX] <- length(which(xSort == xSort[i]))
      indexX <- indexX + 1
  }
}

minX <- min(x)
maxX <- max(x)
k <- 7

n <- length(xSort)

h <- (maxX - minX)/k
numberStr <- array()

for (i in 1:(length(number)-1)) {
    if(i == (length(number)-1)){
      numberStr[i] <-paste0('[',number[i],',',number[i+1],']')
    }else{
      numberStr[i] <-paste0('[',number[i],',',number[i+1],')')
    }
}

numberF  <- array(  )

numberF <- numberFrequency[1:(length(numberFrequency)-1)]

numberF[length(numberF)] <- numberF[length(numberF)] +
  numberFrequency[length(numberFrequency)]




omega <- array()

for (i in 1:length(numberF)) {
   omega[i] <- round(numberF[i] / n, 2)
}

delta <- array(numberFrequency[1])

for (i in 2:(length(numberFrequency)-1) ) {
  delta[i] <- delta[i-1]+numberFrequency[i]
}

delta[length(delta)] <- delta[length(delta)] +
  numberFrequency[length(numberFrequency)]

table <- list(c(numberStr, numberF, omega, delta) )

plot(
  number,
  numberFrequency,
  type = 'o',
  xlab = 'x_i',
  ylab = 'n_i',
  main = 'Полігон частот',
  col ="blue"
)

hist(x,
     border="blue",
     col="green",
     xlab = 'x_i',
     ylab = 'Частота',
     main = 'Гістограма частот' )

