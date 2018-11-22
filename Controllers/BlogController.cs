using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using BLOGLIBRES.Models;
namespace _1.Libres.Controllers
{
    [Route("api/[controller]")]
    public class BlogController : Controller
    {
        FBSLibresContext context = new FBSLibresContext();
        [HttpGet]
        [Route("ListaTema")]
        public List<Tema> Lista()
        {
            return this.context.Tema.ToList();
        }
        [HttpGet]
        [Route("ListaPTodos")]
        public List<Pregunta> ListaTemaTodos()
        {
            return this.context.Pregunta.ToList();
        }
        [HttpGet]
        [Route("ListaPF")]
        public List<Pregunta> ListaTemaFalso()
        {
            return this.context.Pregunta.Where(s => s.Estado == false).ToList();
        }
        [HttpGet]
        [Route("ListaPT")]
        public List<Pregunta> ListaTemaVerdadero()
        {
            return this.context.Pregunta.Where(s => s.Estado == true).ToList();
        }
        [HttpPost]
        [Route("AddPregunta")]
        public List<Pregunta> Obtenerdatos([FromBody]Pregunta comTemp)
        {
            Pregunta nivel = new Pregunta
            {
                Temaid = comTemp.Temaid,
                Pregunta1 = comTemp.Pregunta1,
                Estado = comTemp.Estado
            };
            context.Pregunta.Add(nivel);
            context.SaveChanges();
            return context.Pregunta.ToList();
        }
    }
}
