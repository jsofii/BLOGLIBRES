using System;
using System.Collections.Generic;

namespace BLOGLIBRES.Models
{
    public partial class Usuario
    {
        public Usuario()
        {
            Pregunta = new HashSet<Pregunta>();
            Respuesta = new HashSet<Respuesta>();
        }

        public int Usuarioid { get; set; }
        public string Nombre { get; set; }
        public string Rol { get; set; }

        public ICollection<Pregunta> Pregunta { get; set; }
        public ICollection<Respuesta> Respuesta { get; set; }
    }
}
