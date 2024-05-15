package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/ulasan/pkg/routes"
)

func main() {
	r := mux.NewRouter()

	routes.UlasanRoutes(r)

	http.Handle("/", r)

	fmt.Print("Starting Server localhost:9013")

	log.Fatal(http.ListenAndServe("localhost:9013", r))
}
