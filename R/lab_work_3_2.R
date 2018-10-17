A <- matrix(nrow=3,ncol=3,c(1, 5, 3, 2, 1, -1, 4, 2, 1))
n <- 3
cat('Matrix A : \n')
A

b <- matrix(c(15,12,2))

#знаходимо корені методом Гаусса
Ab <- GaussianElimination(A,b)

cat('За методом Гаусса, у нас отримались наступні коренні')
Ab

cat('Корені рівні :')
  Ab[,n+1]
