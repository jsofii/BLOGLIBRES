using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using BLOGLIBRES.Models;
namespace _1.Libres.Controllers
{
    [Route("api/[controller]")]
    public class RespuestaController : Controller
    {
        FBSLibresContext context = new FBSLibresContext();
        [HttpGet]
        [Route("ListaRespuestas/{preguntaid}")]
        public List<Respuesta> Lista(int preguntaid)
        {
            return this.context.Respuesta.Where(s => s.Preguntaid == preguntaid).ToList();
        }
        [HttpGet]
        [Route("Pregunta/{preguntaid}")]
        public Pregunta Pregunta(int preguntaid)
        {
            Pregunta p = this.context.Pregunta.Find(preguntaid);
            return p;
        }
        [HttpPost]
        [Route("IngresarRespuesta")]
        public List<Respuesta> Respuesta([FromBody] Respuesta respuesta)
        {
            Respuesta res = new Respuesta
            {
                Contenido = respuesta.Contenido,
                Preguntaid = respuesta.Preguntaid

            };
            this.context.Respuesta.Add(res);
            this.context.SaveChanges();
            return this.context.Respuesta.ToList();
        }
        [HttpPost]
        [Route("CambiarEstado")]

        public List<Respuesta> Respuesta([FromBody] Pregunta p)
        {
            //Boolean b = false;
            Pregunta pregunta = this.context.Pregunta.Find(p.Preguntaid);
            pregunta.Estado = true;
            this.context.SaveChanges();
            return this.context.Respuesta.ToList();
        }

        [HttpDelete]
        [Route("Eliminar/{idrespuesta}")]
        public List<Respuesta> Eliminar(int idrespuesta)
        {
            Respuesta res = new Respuesta
            {
                Respuestaid = idrespuesta
            };

            context.Remove(res);
            context.SaveChanges();
            return context.Respuesta.ToList();
        }


    }
}
