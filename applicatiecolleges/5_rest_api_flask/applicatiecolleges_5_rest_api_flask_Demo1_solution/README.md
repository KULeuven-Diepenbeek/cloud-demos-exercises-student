
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email) VALUES 
('John Doe', 'john.doe@example.com'),
('Jane Smith', 'jane.smith@example.com'),
('Alice Johnson', 'alice.johnson@example.com'),
('Bob Brown', 'bob.brown@example.com'),
('Charlie Green', 'charlie.green@example.com'),
('Emily Davis', 'emily.davis@example.com'),
('Michael Wilson', 'michael.wilson@example.com'),
('Sarah White', 'sarah.white@example.com'),
('David King', 'david.king@example.com'),
('Laura Scott', 'laura.scott@example.com');

```
