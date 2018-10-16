numberValue <- function(number,
                        numberCount,
                        firstNumberSt,
                        type){

  Delta <- abs(number - round(number,1))

  index <- 0
  if(type == 'v'){
    for (i in 1:numberCount) {
       if(Delta <= 0.5*10^(firstNumberSt-i+1)){
         index <- index + 1
       }
    }
  }

  if(type == 'sh'){
    for (i in 1:numberCount) {
      if(Delta <= 1*10^(firstNumberSt-i+1)){
        index <- index + 1
      }
    }
  }
  return(index)
}

