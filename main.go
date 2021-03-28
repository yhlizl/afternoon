package main

import (
	_ "afternoon/boot"
	_ "afternoon/router"

	"github.com/gogf/gf/frame/g"
)

func main() {
	g.Server().Run()
}
