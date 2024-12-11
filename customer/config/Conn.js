/**
SQL Connection Module

This module is responsible for setting up and exporting the SQL connection pool that is used
throughout the application to interact with the MySQL database. It uses the mysql2 library 
to create a pool of connections that can be reused for multiple database queries, optimizing 
performance and resource usage.

Dependencies
    mysql2: A MySQL client for Node.js, used to interact with a MySQL database. 
    It provides support for pooling, prepared statements, and asynchronous query execution.

    Module Export
        This module exports an object containing the conn property, which is the MySQL 
        connection pool that can be used to query the database.
 */

// SQL Connection
const sql = require('mysql2');

const conn = sql.createPool({
    host: "database",
    user: "root",
    password: "root",
    database: "boothlink",
    connectionLimit: 15,
    waitForConnections: true,
});


module.exports = {
    conn
}
