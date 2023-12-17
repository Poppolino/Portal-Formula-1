import pandas as pd
import codecs

nomeEscrever = "caminho\\arquivo.txt"
atual = 0;
nome = "caminho\\arquivo.csv"

isString = [[0, 1, 1, 1, 1, 0, 0, 0, 1], [0, 1, 1, 1, 1], [0, 1, 0, 1, 1, 1, 1, 1, 1], [0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], 
            [0, 0, 0, 0, 1, 1, 0], [0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0]]

tabela = pd.read_csv(nome)

tamanho = tabela.shape

with codecs.open(nomeEscrever, 'w', 'utf-8') as f:
    f.write("insert into Circuito values\n")
    for i in range(0, tamanho[0]):
        f.write("(")
        for j in range(0, tamanho[1]):
            original = tabela.iloc[i, j]
            if original == "\\N":
                f.write("NULL, " if j < tamanho[1]-1 else "NULL")
                continue
            string = f'\"{original}\"' if isString[atual][j] == 1 else f'{original}'
            f.write(f'{string}, ' if j < tamanho[1]-1 else string)
        f.write('),\n' if i < tamanho[0]-1 else ');')