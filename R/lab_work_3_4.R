n <- 4

A <- matrix(nrow=n, ncol=n,c(12,3,1,-2,3,13,-4,3,1,-4,14,1,-2,3,1,12))

b <- matrix(c(14,15,12,14))

method_iteration(A = A,
                 b = b,
                 n = n)
