use sureship;

create table users
(  userID int unsigned not null auto_increment primary key,
   username varchar(255),
   email varchar(255),
   password varchar(255),
   address varchar(255)
)

insert into users values
  (1, "johndoe", "johndoe@gmail.com", "12341234", "666 Hell Street Lucifer Block 69 #66-99, Graveyard, 696969"),
  (2, "janedoe", "janedoe@gmail.com", "43214321", "777 Holy Street Michael Block 77 #7-7, Heaven, 121212")

create table products
(  prodID int unsigned not null auto_increment primary key,
   prod_name varchar(255),
   brand varchar(255),
   price float(6,2),
   rating float(6,1),
   prod_date date,
   img_path varchar(255),
   desc_text longtext
);

insert into products values
  (1, "iPhone 16", "Apple", 1299.00, 5.0, "2024-09-20", "assets/iphone-16.webp", "iPhone 16 is built for Apple Intelligence, the personal intelligence system that helps you write, express yourself and get things done effortlessly."),
  (2, "POCO X6 Pro 5G", "POCO", 369.00, 4.9, "2024-01-12", "assets/poco-x6-pro-5g.webp", "Expect stronger peak performance with upgraded ARMv9 architecture and 1+3+4 octa-core configuration."),
  (3, "Xiaomi Redmi Note 13", "Xiaomi", 179.00, 4.9, "2024-01-10", "assets/xiaomi-redmi-note-13.webp", "Create stunning photos with the flagship-level 108MP main camera and multiple smart algorithms."),
  (4, "iPhone 16 Pro Max", "Apple", 1899.00, 4.9, "2024-09-20", "assets/iphone-16-pro-max.webp", "iPhone 16 Pro Max features a Grade 5 titanium design with a new, refined micro-blasted texture." ),
  (5, "OPPO Reno11 F 5G", "OPPO", 399.00, 4.9, "2024-03-29", "assets/oppo-reno-11f-5g.webp", "Enjoy the tranquillity of shimmering, rippling azure waves, like taking a breath of fresh coastal air."),
  (6, "OnePlus 12 5G", "OnePlus", 1149.00, 4.9, "2023-12-11", "assets/oneplus-12-5g.webp", "In the Box: Phone with Pre-applied Screen Protector, USB-Type C Cable (Charger and Phone Case not included)."),
  (7, "OPPO Reno12 5G", "OPPO", 649.00, 4.8, "2024-06-29", "assets/oppo-reno-12-5g.webp", "The OPPO Reno12 5G introduce a suite of industry-leading GenAI features that are set to unlock new realms of productivity and creativity."),
  (8, "Google Pixel 9 Pro XL", "Google", 1669.00, 4.8, "2024-08-22", "assets/google-pixel-9-pro-xl.webp", "Pixel can handle everyday drops, spills and dust. And the display is scratch and damage resistant, made with Corning® Gorilla® Glass Victus® 2."),
  (9, "Xiaomi 14T", "Xiaomi", 1111.00, 4.8, "2024-09-27", "assets/xiaomi-14t.webp", "Utilizing flagship FIAA technology, the chin bezels of the screen are incredibly narrow at 1.9mm, creating a visually balanced effect on all four sides and offering a more immersive viewing experience."),
  (10, "Samsung Galaxy S24 Ultra", "Samsung", 1800.00, 4.8, "2024-01-31", "assets/samsung-galaxy-s24-ultra-5g.webp","Welcome to the era of mobile AI. With Galaxy S24 Ultra in your hands, you can unleash whole new levels of creativity, productivity and possibility.")

