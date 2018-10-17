method_iteration <- function(A,
                             b,
                             n){
  cat("Matrix A")
  print(A)
  # A <- matrix(nrow=n, ncol=n,c(-1,0,-1,1,2,5,0,1,3))

  #b <- matrix(c(1,5,12))

  cat("Matrix b")
  print(b)

  Al <- matrix(nrow=n, ncol=n,rep(0,16))
  bl <- matrix(rep(0,n))
  x0 <- matrix(rep(0,n))

  for (i in 1:n) {
    for (j in 1:n) {
      if(i == j){
        Al[i,j] <- 0
      }else{
        Al[i,j] <- -(A[i,j]/A[i,i])
      }
    }
    bl[i] <- b[i]/A[i,i]
    x0[i] <- bl[i]
  }

  k <- 0
  epsilon <- 10^(-6)

  i<- 0
  repeat{
    max1 <- 0

    for (i in 1:n ) {
      s <- 0
      for (j in 1:n) {
        s <- s + Al[i,j]*x0[j]
      }
      x[i] <- bl[i] + s
    }

    for (i in 1:n){
      if(abs(x[i] - x0[i]) > max1){
        max1 <- abs(x[i] - x0[i])
      }
      x0[i] <- x[i]
    }

    k <- k+1
    if( (max1 < epsilon) | (k > 100) ){
      cat("------------ \n")
      break
    }
  }
  cat("Корені : \n")
  print(matrix(x))

}
