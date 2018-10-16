FunLabWork_2_1 <- function(DeltaC,
                           DeltaM,
                           DeltaN,
                           C,
                           M,
                           N) {
  deltaC2 = 2 * DeltaC / abs(C)

  deltaM2N <-
    (2 * DeltaM / abs(M) + DeltaN / abs(N)) * abs(M ^ 2 * N)

  deltaX <- deltaM2N + deltaC2
  cat("Відносна похибка = ", deltaX, "\n")

  DeltaX <- deltaX * abs(M ^ 2 * N / C ^ 2)

  cat("Абсолютна похибка = ", DeltaX, "\n")
}
