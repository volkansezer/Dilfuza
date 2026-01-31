docker build -t volkansezer/dilfuza:v0.0.1 -f Dockerfile.Dilfuza .

docker build --platform linux/amd64 -t volkansezer/dilfuza:v0.0.1 -f Dockerfile.Dilfuza .

docker build --platform linux/amd64 -t imaj-adi:etiket .

docker tag volkansezer/dilfuza:v0.0.1 volkansezer/dilfuza:v0.0.1
pause