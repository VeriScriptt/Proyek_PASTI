package routes

import (
	"github.com/gorilla/mux"
	"github.com/marihottambunan/ulasan/pkg/controllers"
)

var UlasanRoutes = func(router *mux.Router) {
	router.HandleFunc("/ulasan", controllers.CreateUlasan).Methods("POST")
	router.HandleFunc("/ulasan", controllers.GetUlasan).Methods("GET")
	router.HandleFunc("/ulasan/{id}", controllers.GetUlasanById).Methods("GET")
	router.HandleFunc("/ulasan/{id}", controllers.UpdateUlasan).Methods("PUT")

}
