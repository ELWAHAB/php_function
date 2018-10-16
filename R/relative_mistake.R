relative_mistake <- function(x,
                             Delta){



  cat(" Parameters: \n")
  cat("x = ",x, "\n")
  cat("Delta = ",Delta, "\n")


  delta <- Delta / abs(x)

  cat(" Result: \n")
  cat("Relative mistake  = ",delta ,"\n")
  cat("Absolute mistake  = ",Delta ,"\n")

}
