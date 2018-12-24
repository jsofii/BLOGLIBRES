using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

namespace BLOGLIBRES.Models
{
    public partial class FBSLibresContext : DbContext
    {
        public FBSLibresContext()
        {
        }

        public FBSLibresContext(DbContextOptions<FBSLibresContext> options)
            : base(options)
        {
        }

        public virtual DbSet<Pregunta> Pregunta { get; set; }
        public virtual DbSet<Respuesta> Respuesta { get; set; }
        public virtual DbSet<Tema> Tema { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
                // esta parte seria buena ponerla en el gitignore
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. See http://go.microsoft.com/fwlink/?LinkId=723263 for guidance on storing connection strings.
                optionsBuilder.UseSqlServer("server=DESKTOP-NQEJ9JQ\\DBSOFIA;user=sa;password=sofi;database=FBSLibres");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Pregunta>(entity =>
            {
                entity.ToTable("PREGUNTA");

                entity.Property(e => e.Preguntaid).HasColumnName("PREGUNTAID");

                entity.Property(e => e.Estado).HasColumnName("ESTADO");

                entity.Property(e => e.Pregunta1)
                    .HasColumnName("PREGUNTA")
                    .HasMaxLength(500);

                entity.Property(e => e.Temaid).HasColumnName("TEMAID");

                entity.HasOne(d => d.Tema)
                    .WithMany(p => p.Pregunta)
                    .HasForeignKey(d => d.Temaid)
                    .HasConstraintName("FK_PREGUNTA_TEMA");
            });

            modelBuilder.Entity<Respuesta>(entity =>
            {
                entity.ToTable("RESPUESTA");

                entity.Property(e => e.Respuestaid).HasColumnName("RESPUESTAID");

                entity.Property(e => e.Contenido)
                    .HasColumnName("CONTENIDO")
                    .HasMaxLength(4000);

                entity.Property(e => e.Preguntaid).HasColumnName("PREGUNTAID");

                entity.HasOne(d => d.Pregunta)
                    .WithMany(p => p.Respuesta)
                    .HasForeignKey(d => d.Preguntaid)
                    .HasConstraintName("FK_RESPUESTA_PREGUNTA");
            });

            modelBuilder.Entity<Tema>(entity =>
            {
                entity.ToTable("TEMA");

                entity.Property(e => e.Temaid).HasColumnName("TEMAID");

                entity.Property(e => e.Nombre)
                    .HasColumnName("NOMBRE")
                    .HasMaxLength(50);
            });
        }
    }
}
