
import numpy as np
from array import *

class Perceptron():

    def __init__(self, n_ep=10, speed = 0.1):
        self.n_ep = n_ep
        self.speed_of_learning = speed

    def fit(self, X, y1, y2, y3):
        print("Начато обучение...")
        self.w_array1 = np.zeros(X.shape[1] + 1)
        self.w_array2 = np.zeros(X.shape[1] + 1)
        self.w_array3 = np.zeros(X.shape[1] + 1)

        for epoha in range(self.n_ep):
            for i in range(X.shape[0]):
                delta1 = self.speed_of_learning * (y1[i] - self.predict(X[i]))
                delta2 = self.speed_of_learning * (y2[i] - self.predict(X[i]))
                delta3 = self.speed_of_learning * (y3[i] - self.predict(X[i]))
                for j in range(0, len(self.w_array1)-1):
                    self.w_array1[j] += delta1 * X[i][j]
                    self.w_array2[j] += delta2 * X[i][j]
                    self.w_array3[j] += delta3 * X[i][j]
                self.w_array1[len(self.w_array1)-1] += delta1
                self.w_array2[len(self.w_array2) - 1] += delta2
                self.w_array3[len(self.w_array3) - 1] += delta3

    def predict(self, x):
        x = np.append(x, 1)
        arrays = [sum(self.w_array1*x), sum(self.w_array2*x), sum(self.w_array3*x)]
        z = arrays.index(max(arrays))
        return z




percept = Perceptron(n_ep = 100, speed=0.01)


X = np.array([[0, 0],
              [1, 1],
              [1, 0],
              [0, 1]])

y1 = np.array([0,
              1,
              1,
              1])

y2 = np.array([1,
              1,
              0,
              0])

y3 = np.array([0,
              1,
              0,
              0])



percept.fit(X, y1, y2, y3)




while True:
    x1 = int(input("Введите первое число\n"))
    x2 = int(input("Введите второе число\n"))
    print(x1, "or", x2, "=", percept.predict([x1, x2]), "\n")
