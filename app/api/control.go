package api

import (
	_ "fmt"
	_ "github.com/gogf/gf/database/gdb"
	"github.com/gogf/gf/frame/g"
	"github.com/gogf/gf/net/ghttp"
)

var Control = controlApi{}

type controlApi struct {
}

func (a *controlApi) Close(r *ghttp.Request) {

	v := g.View()
	v.SetPath("template/Afternoon-tea-main")
	r_id := r.GetString("id")

	sql := `update meal_info set status='close' where id='` + r_id + `';`

	db := g.DB("MITD")
	_, _ = db.Exec(sql)

	r.Response.WriteJson(g.Map{
		"success": true,
		"sql":     sql,
	})

}
