number <- 3.751

n <- numberValue(number = number,
                 numberCount = 4,
                 firstNumberSt = 0, #power number
                 type = 'v')

delta <- relativeLimitMistake(firstNumber = 3,
                                n = n,
                                type = 'v')
cat("Відносна гранична похибка у вузькому розумінні = ", delta)

Delta <- absolutlyLimitMistake(delta = delta,
                               number = number)

cat("Абсолютна гранична похибка у вузькому розумінні = ",Delta)

##################################

number <- 0.537

n <- numberValue(number = number,
                 numberCount = 4,
                 firstNumberSt = -1, #power number
                 type = 'sh')

delta <- relativeLimitMistake(firstNumber = 5,
                              n = n,
                              type = 'sh')
cat("Відносна гранична похибка у широкому розумінні = ", delta)

Delta <- absolutlyLimitMistake(delta = delta,
                               number = number)

cat("Абсолютна гранична похибка у широкому розумінні = ",Delta)

