
let str = "Hello, World!";
let name = "John";

// Basic Operations
console.log(str.length);                    // 13
console.log(str.toUpperCase());             // "HELLO, WORLD!"
console.log(str.toLowerCase());             // "hello, world!"
console.log(str.charAt(1));                  // "e"
console.log(str.indexOf("World"));           // 7
console.log(str.includes("hello"));          // false

// String Manipulation
console.log(str.substring(0, 7));            // "Hello,"
console.log(str.slice(7, 12));               // "World"
console.log(str.replace("World", "JavaScript")); // "Hello, JavaScript!"
console.log(str.split(", "));                 // ["Hello", "World!"]
console.log("trim me".trim());          // "trim me"
console.log(name.padStart(10, "J"));          //JJJJJJJohn
console.log(name.repeat(3));                  // "JohnJohnJohn"