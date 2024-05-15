package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/gorilla/mux"
	"github.com/steveganteng/auth/controllers"
	"github.com/steveganteng/auth/models"
)

func main() {

	models.ConnectDatabase()
	r := mux.NewRouter()

	r.HandleFunc("/login", controllers.Login).Methods("POST")
	r.HandleFunc("/register", controllers.Register).Methods("POST")
	r.HandleFunc("/logout", controllers.Logout).Methods("POST")

	fmt.Print("Starting Server localhost:8083")
	// fmt.Println("Starting Server localhost:8082") // Menampilkan pesan bahwa server dimulai di localhost:9010.
	log.Fatal(http.ListenAndServe(":8083", r))

}
