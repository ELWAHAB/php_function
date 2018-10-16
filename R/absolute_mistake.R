absolute_mistake <- function(x,
                              delta,
                              number_round){
  a <- round(x,number_round)


  cat(" Parameters: \n")
  cat("x = ",x, "\n")
  cat("delta = ",delta, "\n")



  Delta <- delta * abs(a)
  cat(" Result: \n")
  cat("Relative mistake  = ",delta ,"\n")
  cat("Absolute mistake  = ",Delta ,"\n")
}




