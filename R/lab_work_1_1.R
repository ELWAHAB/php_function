
solve_eq <- function(x, a){
  A <- x
  a <- a
  Delta <- abs(A-a)
  delta <- Delta / abs(A)
  return(delta)
}

solve_all <-  function(first_eq_A,
                       first_eq_a,
                       second_eq_A,
                       second_eq_a){


  first_solve <- solve_eq(first_eq_A, first_eq_a)

  second_solve <- solve_eq(second_eq_A, second_eq_a)

  cat(" Parametrs: \n")
  cat("first_eq_A = ",first_eq_A, "\n")
  cat("first_eq_a = ",first_eq_a, "\n")
  cat("second_eq_A = ",second_eq_A, "\n")
  cat("second_eq_a = ",second_eq_a, "\n")

  cat(" Result: \n")
  cat("Pohubka first solve = ",first_solve ,"\n")
  cat("Pohubka second solve =",second_solve ,"\n")
  cat("\n")

  if(first_solve > second_solve){
    cat("Exactly second solve: ", second_solve)
  }else{
    cat("Exactly first solve: ", first_solve)
  }
}


