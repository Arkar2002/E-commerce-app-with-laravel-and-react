import Heading from "./Heading";
import SelectBox from "./SelectBox";

function SelectionBox({ categories, brands }) {
  return (
    <div className="sticky top-0 w-full min-w-64 space-y-5 divide-y divide-dotted divide-gray-200 overflow-hidden rounded bg-white px-4 py-3 pb-6 shadow">
      <div className="space-y-2">
        <Heading size="sm">Categories</Heading>
        <SelectBox
          options={categories?.map((data) => data.title)}
          label="categories"
        />
      </div>
      <div className="space-y-2 pt-2">
        <Heading size="sm">Brands</Heading>
        <SelectBox options={brands?.map((data) => data.title)} label="brands" />
      </div>
    </div>
  );
}

export default SelectionBox;
