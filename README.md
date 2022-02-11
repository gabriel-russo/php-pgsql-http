### Build docker:

1 - `docker build -t phpsql . `

2 - `docker-compose up`

### PostgreSQL table

```sql
CREATE TABLE Comentarios(
  id serial,
  nome text,
  comentario text,
  PRIMARY KEY(id)
);
`
