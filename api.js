/*jshint esversion: 6 */
const execPhp = require('exec-php');
const express = require("express");
const bodyParser = require("body-parser");
const ejs = require("ejs");
//const mongoose = require('mongoose');
const multer = require('multer');
const app = express();

//app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({
  extended: true
}));
//app.use(express.static("public"));

const storage = multer.diskStorage({
  destination: function(req, file, cb) {
    cb(null, 'uploads/');
  },
  filename: function(req, file, cb) {
    cb(null, file.originalname);
  }
});

const fileFilter = (req, file, cb) => {
  // reject a file
  if (file.mimetype === 'text/plain' || file.mimetype === 'text/plain') {
    cb(null, true);
  } else {
    cb(null, false);
  }
};

const upload = multer({
  storage: storage,
  limits: {
    fileSize: 1024 * 1024 * 5
  },
  fileFilter: fileFilter
});

app.post("/", upload.single('text'), (req, res, next) => {
  // const product = new Product({
  //   _id: new mongoose.Types.ObjectId(),
  //   name: req.body.name,
  //   price: req.body.price,
  //   productImage: req.file.path
  // });
  // product
  //   .save()
  //   .then(result => {
  //     console.log(result);
  //     res.status(201).json({
  //       message: "Created product successfully",
  //       createdProduct: {
  //           name: result.name,
  //           price: result.price,
  //           _id: result._id,
  //           request: {
  //               type: 'GET',
  //               url: "http://localhost:3000/products/" + result._id
  //           }
  //       }
  //     });
  //   })
  //   .catch(err => {
  //     console.log(err);
  //     res.status(500).json({
  //       error: err
  //     });
  //   });
    var x="";
    execPhp('apiinit.php', function(error, php, outprint){
  // outprint is now `One'.
      php.test("successfull ", function(err, result, output, printed){
      .
        console.log("before");

        console.log("still running");
    
        res.send(result);
        
      });

    });


});


app.listen(3000, function() {
  console.log("Server started on port 3000");
});
