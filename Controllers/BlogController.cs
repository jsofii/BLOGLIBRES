using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using BLOGLIBRES.Models;
namespace _1.Libres.Controllers
{
   
    public class Temas{
         public int Preguntaid { get; set; }
        public string Pregunta1 { get; set; }
        public bool? Estado { get; set; }
        public int? Usuarioid { get; set; }
        public string Nombre { get; set; }
        public string Rol { get; set; }
          public DateTime? Fecha { get; set; }

    }
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
        [Route("TodasPreguntas")]
        public List<Temas> TodasPreguntas()
        {
            var query = from com in context.Pregunta
                        join prov in context.Usuario on com.Usuarioid equals prov.Usuarioid
                        
                        select new Temas
                        {
                            Preguntaid=com.Preguntaid,
                            Pregunta1=com.Pregunta1,
                            Estado=com.Estado,
                            Usuarioid=com.Usuarioid,
                            Nombre=prov.Nombre,
                            Rol=prov.Rol,
                            Fecha= com.Fecha


                        };

            return query.ToList();
         
        }
        [HttpGet]
        [Route("ListaPTodos")]
        public List<Pregunta> ListaTemaTodos()
        {
            return this.context.Pregunta.ToList();
        }
        // [HttpGet]
        // [Route("ListaPF/{idTema}")]
        // public List<Pregunta> ListaTemaFalso(int idTema)
        // {
        //     return this.context.Pregunta.Where(Pregunta => Pregunta.Temaid == idTema).Where(s => s.Estado == false).ToList();
        // }
        // [HttpGet]
        // [Route("ListaPT/{idTema}")]
        // public List<Pregunta> ListaTemaVerdadero(int idTema)
        // {
        //     return this.context.Pregunta.Where(Pregunta => Pregunta.Temaid == idTema).Where(s => s.Estado == true).ToList();
        // }
        [HttpGet]
        [Route("ListaPT")]
        public List<Pregunta> ListaTemaVerdadero()
        {
            return this.context.Pregunta.Where(s => s.Estado == true).ToList();
        }
        [HttpPost]
        [Route("AddPregunta")]
        public List<Pregunta> AddPregunta([FromBody]Pregunta comTemp)
        {
            Pregunta nivel = new Pregunta
            {
               
                Pregunta1 = comTemp.Pregunta1,
                Estado = comTemp.Estado,
                Usuarioid= comTemp.Usuarioid,
                Fecha=DateTime.Now
            };
            context.Pregunta.Add(nivel);
            context.SaveChanges();
            return context.Pregunta.ToList();
        }
    }
}
