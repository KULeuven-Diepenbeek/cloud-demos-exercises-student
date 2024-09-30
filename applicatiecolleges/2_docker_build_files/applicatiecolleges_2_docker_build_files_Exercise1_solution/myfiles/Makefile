CC = gcc
TARGET = program
SRC = main.c

build: $(SRC)
	$(CC) -o $(TARGET) $(SRC)

clean:
	rm -f $(TARGET)

run: build
	./$(TARGET)