n <- 4

A <- matrix(nrow=n, ncol=n,c(12,3,1,-2,3,13,-4,3,1,-4,14,1,-2,3,1,12))
# A <- matrix(nrow=n, ncol=n,c(-1,0,-1,1,2,5,0,1,3))
b <- matrix(c(14,15,12,14))
#b <- matrix(c(1,5,12))


LU_matrix(n = n,
          A = A,
          b = b)





