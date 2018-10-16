FunLabWork_2_2 <- function(DeltaA,
                           DeltaB,
                           DeltaC,
                           DeltaD,
                           DeltaM,
                           A,
                           B,
                           C,
                           D,
                           M) {
  deltaCD <- (DeltaC + DeltaD) / abs(C + D)

  deltaMAB <-
    DeltaM / abs(M) + 1 / 2 * ((DeltaA + DeltaB) / abs(A - B))

  deltaX <- deltaMAB + deltaCD
  cat("Відносна похибка = ", deltaX, "\n")

  DeltaX <- deltaX * abs((M * sqrt(A - B)) / (C + D))
  cat("Абсолютна похибка = ", DeltaX, "\n")
}
