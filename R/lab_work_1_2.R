absolutly_pohubka <- function(x,
                              delta,
                              ...){
  a <- round(x,number_round)


  cat(" Parameters: \n")
  cat("x = ",x, "\n")
  cat("delta = ",delta, "\n")



  Delta <- delta * abs(a)
  cat(" Result: \n")
  cat("Відносна похибка = ",delta ,"\n")
  cat("Абсолютна похибка = ",Delta ,"\n")

}



vidnosna_pohubka <- function(x,
                              Delta,
                              ...){
  a <- round(x,number_round)


  cat(" Parameters: \n")
  cat("x = ",x, "\n")
  cat("Delta = ",Delta, "\n")


  delta <- Delta / abs(a)

  cat(" Result: \n")
  cat("Відносна похибка = ",delta ,"\n")
  cat("Абсолютна похибка = ",Delta ,"\n")

}




