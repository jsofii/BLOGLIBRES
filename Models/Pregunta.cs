using System;
using System.Collections.Generic;

namespace BLOGLIBRES.Models
{
    public partial class Pregunta
    {
        public Pregunta()
        {
            Respuesta = new HashSet<Respuesta>();
        }

        public int Preguntaid { get; set; }
        public string Pregunta1 { get; set; }
        public int? Temaid { get; set; }
        public bool? Estado { get; set; }

        public Tema Tema { get; set; }
        public ICollection<Respuesta> Respuesta { get; set; }
    }
}
