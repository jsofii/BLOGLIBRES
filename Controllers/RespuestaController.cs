using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using BLOGLIBRES.Models;
namespace _1.Libres.Controllers

{
     public class RespuestaFinal{
          public int Respuestaid { get; set; }
        public string Contenido { get; set; }
        public int? Preguntaid { get; set; }
        public string Titulo { get; set; }
        public int? Usuarioid { get; set; }
        public DateTime? Fecha { get; set; }
        public string Imagen { get; set; }
        public string Video { get; set; }
      
        public string Nombre { get; set; }
        public string Rol { get; set; }
       

    }
    [Route("api/[controller]")]
    public class RespuestaController : Controller
    {
        FBSLibresContext context = new FBSLibresContext();
        [HttpGet]
        [Route("ListaRespuestas/{preguntaid}")]
        public List<RespuestaFinal> Lista(int preguntaid)
        {
              var query = from com in context.Respuesta
                        join prov in context.Usuario on com.Usuarioid equals prov.Usuarioid
                        where com.Preguntaid== preguntaid
                        
                        select new RespuestaFinal
                        {
                            Preguntaid=com.Preguntaid,
                            Respuestaid=com.Respuestaid,
                            Contenido=com.Contenido,
                            Titulo=com.Titulo,
                            Usuarioid=com.Usuarioid,
                            Fecha=com.Fecha,
                            Imagen=com.Imagen,
                            Video=com.Video,
                            Nombre=prov.Nombre,
                            Rol=prov.Rol
                            


                        };
            return query.ToList();
        }
         [HttpGet]
        [Route("prueba")]
        public List<Respuesta> prueba(int preguntaid)
        {
            return this.context.Respuesta.ToList();
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
                Preguntaid = respuesta.Preguntaid,
                Titulo= respuesta.Titulo,
                Usuarioid=respuesta.Usuarioid,
                Fecha=DateTime.Now,
                Video=respuesta.Video,
                Imagen=respuesta.Imagen
               
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
