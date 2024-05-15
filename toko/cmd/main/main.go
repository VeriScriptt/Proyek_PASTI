package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/toko/pkg/routes"
)

func main() {
	r := mux.NewRouter()

	routes.TokoRoutes(r)

	http.Handle("/", r)

	fmt.Print("Starting Server localhost:9012")

	log.Fatal(http.ListenAndServe("localhost:9012", r))
}
