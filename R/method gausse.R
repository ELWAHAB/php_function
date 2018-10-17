A <- matrix(nrow=3,ncol=3,c(1, 5, 3, 2, 1, -1, 4, 2, 1))
n <- 3
cat('Matrix A : \n')
A

b <- matrix(c(15,12,2))

mas <- cbind(A,b)
x <- rep(0,n+1)
  # double mas[N] [N + 1];
  # double x[N]; #Корни системы
  # int otv[N]; #Отвечает за порядок корней
  # int i, j, k, n;
  # #Ввод данных


  #Сначала все корни по порядку

    otv <- 1:(n+1)
  #Прямой ход метода Гаусса
  for ( k in 1:n )
  { #На какой позиции должен стоять главный элемент
    glavelem( k, mas, n, otv ); #Установка главного элемента
    if ( abs( mas[k,k] ) < 0.0001 )
    {
      cat( "Система не имеет единственного решения \n" )
      cat( 0 )
    }
    for ( j in n:k  )
      mas[k,j] <- mas[k,j]/mas[k,k];
      for ( i in k:n  )
        for ( j in  n:k )
          mas[i,j] <- mas[i,j] - mas[k,j] * mas[i,k];
  }
  #Обратный ход
  for ( i in 1:n )
    x[i] <- mas[i,n];
  for ( i in (n - 1):1 )
    for ( j in (i + 1): n )
      x[i] <- x[i] - x[j] * mas[i,j]

#----------------------------------------------
  #Описание  функции
#----------------------------------------------
  glavelem <- function( k,
                        mas,
                        n,
                        otv)
{
   i <- k
   j <- k
  i_max <- k
  j_max <- k;
   temp <- NULL
  #Ищем максимальный по модулю элемент
  for ( i in k:n)
    for ( j in k:n)
      if ( abs( mas[i_max,j_max] ) < abs( mas[i,j] ) )
      {
        i_max = i;
        j_max = j;
      }
  #Переставляем строки
  for ( j in k:(n + 1) )
  {
    temp = mas[k,j];
    mas[k,j] = mas[i_max,j];
    mas[i_max, j] = temp;
  }
  #Переставляем столбцы
  for ( i in 1:n )
  {
    temp = mas[i,k];
    mas[i,k] = mas[i, j_max];
    mas[i, j_max] = temp;
  }
  #Учитываем изменение порядка корней
  i = otv[k];
  otv[k] = otv[j_max];
  otv[j_max] = i;
  }
