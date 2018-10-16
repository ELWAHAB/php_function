A <- matrix(nrow=3,ncol=3,c(1, 5, 3, 2, 1, -1, 4, 2, 1))

cat('Matrix A : \n')
A

b <- matrix(c(15,12,2))

cat('\n Matrix b : \n')
b
c <- subset.matrix(A)
x <- solve(A,b)

cat('\n Matrix x : \n')
x

cat('\n Провіряємо відповідь : \n')

 A%*%x          # right answer?
