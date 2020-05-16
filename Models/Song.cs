using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace WebAppE.Models
{
    public class Song
    {
        public int Id { get; set; }
        [Required(ErrorMessage = "Name is required!")]
        [StringLength(100, ErrorMessage = "Maximal length of the name of a song is 100 characters!")]
        public String Name { get; set; }
        [Required(ErrorMessage = "Artist is required!")]
        [StringLength(100, ErrorMessage = "Maximal length of the name of an artist is 100 characters!")]
        public String Artist { get; set; }
        public int GenreId { get; set; }

        public String GenreName(int givenId, IEnumerable<WebAppE.Models.Genre> genres)
        {
            String name = genres.First(a => a.Id == givenId).Name;
            return name;
        }
    }
}