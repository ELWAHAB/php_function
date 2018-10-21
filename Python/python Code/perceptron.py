class Perceptron():

    def __init__(self, epochaCount, eta):
        self.epochaCount = epochaCount
        self.eta = eta
        print("Work")


    #function of act with Vector
    def multV(self,first,second):
        mult = []
        for i in range(len(first)):
            mult.append(first[i]*second[i])
        return mult

    def multScalVect(self,scalar, vect):
        mult = []
        for i in range(len(vect)):
            mult.append(scalar*vect[i])
        return mult

    def sumV(self,first, second):
        sumVector = []
        for i in range(len(first)):
            sumVector.append(first[i] + second[i])
        return sumVector

    def inputCol(self, X):
        for i in range(len(X)):
            X[i].insert(0,1)
        return X

    #функция для обучения
    def fit(self, X, y):
        xMatrix =  self.inputCol(X)
        # print("\n xMatrix =",xMatrix[0], "\n")
        self.weight = []
        deltaW = []

        for i in range(len(xMatrix[0])):
            self.weight.append(0)
            deltaW.append(0)

        for indexEpoch in range(self.epochaCount):
            wVector = self.weight.copy()
            for indexX in range(len(xMatrix)):
                yHat = self.predict(xMatrix[indexX])
                deltaW = self.multScalVect(self.eta*(y[indexX] - yHat),xMatrix[indexX])
                self.weight = self.sumV(self.weight,deltaW)
            if self.weight == wVector:
                break



    #предсказует варианти
    def predict(self, x):
        z = sum(self.multV(self.weight,x))
        if z >= 0:
            answer = 1
        else:
            answer = 0
        return answer



perceptron = Perceptron(epochaCount= 10, eta= 0.5)

X =[[0,0],
    [0,1],
    [1,0],
    [1,1]]

y = [0,
     0,
     0,
     1]

perceptron.fit(X,y)
print(perceptron.predict([1,1,0]))

# print(perceptron.multV([1,8,10],[5,10,9]))
# print( perceptron.sumV([1,5,7],[4,15,7]))
# print(0.5*1)