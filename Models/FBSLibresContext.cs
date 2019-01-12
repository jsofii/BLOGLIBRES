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
        public virtual DbSet<Usuario> Usuario { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
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

                entity.Property(e => e.Fecha)
                    .HasColumnName("FECHA")
                    .HasColumnType("datetime");

                entity.Property(e => e.Pregunta1)
                    .HasColumnName("PREGUNTA")
                    .HasMaxLength(500);

                entity.Property(e => e.Usuarioid).HasColumnName("USUARIOID");

                entity.HasOne(d => d.Usuario)
                    .WithMany(p => p.Pregunta)
                    .HasForeignKey(d => d.Usuarioid)
                    .HasConstraintName("FK_PREGUNTA_PREGUNTA");
            });

            modelBuilder.Entity<Respuesta>(entity =>
            {
                entity.ToTable("RESPUESTA");

                entity.Property(e => e.Respuestaid).HasColumnName("RESPUESTAID");

                entity.Property(e => e.Contenido)
                    .HasColumnName("CONTENIDO")
                    .HasMaxLength(400);

                entity.Property(e => e.Fecha)
                    .HasColumnName("FECHA")
                    .HasColumnType("datetime");

                entity.Property(e => e.Imagen)
                    .HasColumnName("IMAGEN")
                    .HasMaxLength(40);

                entity.Property(e => e.Preguntaid).HasColumnName("PREGUNTAID");

                entity.Property(e => e.Titulo)
                    .HasColumnName("TITULO")
                    .HasMaxLength(400);

                entity.Property(e => e.Usuarioid).HasColumnName("USUARIOID");

                entity.Property(e => e.Video)
                    .HasColumnName("VIDEO")
                    .HasMaxLength(40);

                entity.HasOne(d => d.Pregunta)
                    .WithMany(p => p.Respuesta)
                    .HasForeignKey(d => d.Preguntaid)
                    .HasConstraintName("FK_RESPUESTA_PREGUNTA");

                entity.HasOne(d => d.Usuario)
                    .WithMany(p => p.Respuesta)
                    .HasForeignKey(d => d.Usuarioid)
                    .HasConstraintName("FK_RESPUESTA_USUARIO");
            });

            modelBuilder.Entity<Tema>(entity =>
            {
                entity.ToTable("TEMA");

                entity.Property(e => e.Temaid).HasColumnName("TEMAID");

                entity.Property(e => e.Nombre)
                    .HasColumnName("NOMBRE")
                    .HasMaxLength(50);
            });

            modelBuilder.Entity<Usuario>(entity =>
            {
                entity.ToTable("USUARIO");

                entity.Property(e => e.Usuarioid)
                    .HasColumnName("USUARIOID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Nombre)
                    .HasColumnName("NOMBRE")
                    .HasMaxLength(50);

                entity.Property(e => e.Rol)
                    .HasColumnName("ROL")
                    .HasMaxLength(50);
            });
        }
    }
}
