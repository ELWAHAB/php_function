LU_matrix <- function(n = 3,
                      A = matrix(nrow=n, ncol=n,c(-1,0,-1,1,2,5,0,1,3)),
                      b = matrix(c(1,5,12))){
  cat('Matrix A : \n')
  print(A)

  cat('\n Matrix b : \n')
  print(b)

  y <-  rep(0,n)
  x <-  rep(0,n)
  library(matlab)
  L <- eye(n)
  U <- eye(n)

  #find L_ij and U_ij
  for (i in 1:n) {
    for (j in 1:n) {
      if(i >= j){
        suma <- 0
        if(j-1>0){
          suma <- sum(L[i,1:(j-1)]*U[1:(j-1),j])
        }
        L[i,j] <- A[i,j] - suma
      }else{
        suma <- 0
        if(i-1>0){
          suma <- sum(L[i,1:(i-1)]*U[1:(i-1),j])
        }
        U[i,j] <- (A[i,j]-suma)/L[i,i]
      }
    }
  }

  cat('\n Matrix L = \n')
  print(L)

  cat('\n Matrix U = \n')
  print(U)


  #multiplication matrix L on vector b
  y <- solve(L,b)

  cat('\n Vector y = \n')
  print(y)


  #multiplication matrix U on vector y
  x <- solve(U,y)

  cat('\n Answer, vector x = \n')
  print(x)
}
