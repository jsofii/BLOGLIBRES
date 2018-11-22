using System;
using System.Collections.Generic;

namespace BLOGLIBRES.Models
{
    public partial class Tema
    {
        public Tema()
        {
            Pregunta = new HashSet<Pregunta>();
        }

        public int Temaid { get; set; }
        public string Nombre { get; set; }

        public ICollection<Pregunta> Pregunta { get; set; }
    }
}
