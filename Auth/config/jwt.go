package config

import (
	"github.com/golang-jwt/jwt/v5"
)

var JWT_KEY = []byte("ajsdno1oah0d8129123asdadnslqwi02")

type JWTClaim struct {
	Username string
	jwt.RegisteredClaims
}
