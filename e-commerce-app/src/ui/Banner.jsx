import Button from "./Button";

function Banner() {
  return (
    <div
      className="flex h-[50vh] items-center bg-cover bg-center bg-no-repeat py-36"
      style={{ backgroundImage: `url("/images/banner-bg.jpg")` }}
    >
      <div className="container space-y-4">
        <div className="font-medium capitalize text-gray-800 sm:text-lg md:text-2xl lg:text-3xl">
          Best Collection for <br /> Home decoration
        </div>
        <p className="sm:text-xs md:text-sm">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur
          hic rem obcaecati <br /> voluptatum sint tenetur sed autem, sit eos?
          Adipisci ducimus velit reiciendis nisi soluta nihil laudantium sed
          quos suscipit.
        </p>
        <Button size="md" to={"/shop"}>
          Shop Now
        </Button>
      </div>
    </div>
  );
}

export default Banner;
