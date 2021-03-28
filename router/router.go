package router

import (
	"afternoon/app/api"
	"fmt"
	"github.com/gogf/gf/frame/g"
	_ "github.com/gogf/gf/net/ghttp"
	"github.com/gogf/gf/os/gsession"
)

func init() {
	s := g.Server()
	s.SetIndexFolder(false)
	s.SetServerRoot("template/Afternoon-tea-main")
	sessionStorage := g.Config().GetString("SessionStorage")
	fmt.Println(sessionStorage)
	s.SetConfigWithMap(g.Map{
		"SessionStorage": gsession.NewStorageMemory(),
	})
	v := g.View()
	v.SetPath("template/Afternoon-tea-main")
	v.SetDelimiters("${{", "}}")
	group := s.Group("/")
	group.GET("/", api.Index)

	group.POST("/checkmember", api.Checkmember)
	group.GET("/logout", api.Logout)

	group.Middleware(api.Member.MiddlewareAuth)
	group.ALL("/meal", api.Meal)
	group.ALL("/detail", api.Detail)
	group.ALL("/control", api.Control)
	group.ALL("/export", api.Export)

	group.POST("/member", api.Member)
	group.GET("/member/show", api.Member.Show)

}
