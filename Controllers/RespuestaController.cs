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
            Pregunta p=this.context.Pregunta.Find(preguntaid);
            return p;
        }

    }
}
