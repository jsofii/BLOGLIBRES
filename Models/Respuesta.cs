using System;
using System.Collections.Generic;

namespace BLOGLIBRES.Models
{
    public partial class Respuesta
    {
        public int Respuestaid { get; set; }
        public string Contenido { get; set; }
        public int? Preguntaid { get; set; }
        public string Titulo { get; set; }
        public int? Usuarioid { get; set; }
        public DateTime? Fecha { get; set; }

        public Pregunta Pregunta { get; set; }
        public Usuario Usuario { get; set; }
    }
}
