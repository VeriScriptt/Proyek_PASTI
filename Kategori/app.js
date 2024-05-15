const express = require("express");
const bodyParser = require("body-parser");
const app = express();
const conn = require("./config/db");

// Middleware for parsing JSON bodies
app.use(bodyParser.json());

// API Read
app.get("/kategori", function (req, res) {
  const queryStr = "SELECT * FROM kate";
  conn.query(queryStr, (err, results) => {
    if (err) {
      console.log(err);
      res.status(500).json({
        success: false,
        message: "Failed to retrieve data",
        error: err.message,
      });
    } else {
      res.status(200).json({
        success: true,
        message: "Success retrieving data",
        data: results,
      });
    }
  });
});

// API Create
app.post("/kategori/create", function (req, res) {
  const param = req.body;
  const kategori = param.nama_kategori;

  const queryStr = "INSERT INTO kate (nama_kategori) VALUES (?)";
  const values = [kategori];

  conn.query(queryStr, values, (err, results) => {
    if (err) {
      console.log(err);
      res.status(500).json({
        success: false,
        message: "Failed to save data",
        error: err.message,
      });
    } else {
      res.status(200).json({
        success: true,
        message: "Success saving data",
        data: results,
      });
    }
  });
});

// API Edit
app.put("/kategori/:id", function (req, res) {
  const id = req.params.id;
  const param = req.body;
  const kategori = param.nama_kategori;

  // Validate if 'kategori' parameter is not null
  if (!kategori) {
    return res.status(400).json({
      success: false,
      message: "Parameter 'kategori' cannot be null",
    });
  }

  const queryStr = "UPDATE kate SET nama_kategori = ? WHERE id = ?";
  const values = [kategori, id];

  conn.query(queryStr, values, (err, results) => {
    if (err) {
      console.log(err);
      res.status(500).json({
        success: false,
        message: "Failed to edit data",
        error: err.message,
      });
    } else {
      res.status(200).json({
        success: true,
        message: "Success editing data",
        data: results,
      });
    }
  });
});

// API Get Warta by ID
app.get("/kategori/:id", function (req, res) {
  const id = req.params.id;

  const queryStr = "SELECT * FROM kate WHERE id = ?";
  const values = [id];

  conn.query(queryStr, values, (err, results) => {
    if (err) {
      console.log(err);
      res.status(500).json({
        success: false,
        message: "Failed to retrieve kategori",
        error: err.message,
      });
    } else {
      if (results.length === 0) {
        res.status(404).json({
          success: false,
          message: "Warta not found",
        });
      } else {
        res.status(200).json({
          success: true,
          message: "Success retrieving kategori",
          data: results[0], // Assuming only one kategori should be returned
        });
      }
    }
  });
});

// app.delete("/kategori/:id", function (req, res) {
//   const id = req.params.id;

//   const queryStr = "DELETE FROM kate WHERE id = ?";
//   const values = [id];

//   conn.query(queryStr, values, (err, results) => {
//     if (err) {
//       console.log(err);
//       res.status(500).json({
//         success: false,
//         message: "Failed to retrieve kategori",
//         error: err.message,
//       });
//     } else {
//       if (results.length === 0) {
//         res.status(404).json({
//           success: false,
//           message: "Warta not found",
//         });
//       } else {
//         res.status(200).json({
//           success: true,
//           message: "Success kategori delete",
//           data: results[0], // Assuming only one kategori should be returned
//         });
//       }
//     }
//   });
// });

const mysql = require("mysql");

// Koneksi ke database yang berisi tabel 'kate'
const connKate = mysql.createConnection({
  host: "127.0.0.1",
  user: "root",
  password: "",
  database: "microservice_kategori",
});

// Koneksi ke database yang berisi tabel 'produks'
const connProduks = mysql.createConnection({
  host: "127.0.0.1",
  user: "root",
  password: "",
  database: "microservice_produk",
});

app.delete("/kategori/:id", function (req, res) {
  const id = req.params.id;

  const deleteProduksQuery = "DELETE FROM produks WHERE id_kategori = ?";
  const deleteKategoriQuery = "DELETE FROM kate WHERE id = ?";
  const values = [id];

  // Menghapus data terkait di tabel produks terlebih dahulu
  connProduks.query(deleteProduksQuery, values, (err, results) => {
    if (err) {
      console.log(err);
      res.status(500).json({
        success: false,
        message: "Failed to delete related produks",
        error: err.message,
      });
    } else {
      // Setelah menghapus data terkait di tabel produks, lanjutkan menghapus kategori
      connKate.query(deleteKategoriQuery, values, (err, results) => {
        if (err) {
          console.log(err);
          res.status(500).json({
            success: false,
            message: "Failed to delete kategori",
            error: err.message,
          });
        } else {
          if (results.affectedRows === 0) {
            res.status(404).json({
              success: false,
              message: "Kategori not found",
            });
          } else {
            res.status(200).json({
              success: true,
              message: "Success kategori delete",
            });
          }
        }
      });
    }
  });
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});

app.listen(2005);
