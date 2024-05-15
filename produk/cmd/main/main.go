package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/gorilla/mux"
	"github.com/marihottambunan/produk/pkg/routes"
)

func main() {
	r := mux.NewRouter()

	routes.ProdukRoutes(r)

	http.Handle("/", r)

	fmt.Print("Starting Server localhost:9011")

	log.Fatal(http.ListenAndServe("localhost:9011", r))
}
