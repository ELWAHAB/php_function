relativeLimitMistake <- function(firstNumber,
                                 n,
                                 type){

  if(type == 'v'){
    t = round(1/(2 * firstNumber*10^(n-1)),5)
    return(t)
  }
  if(type == 'sh'){
    t = round(1/(firstNumber*10^(n-1)),5)
    return(t)
  }

}
