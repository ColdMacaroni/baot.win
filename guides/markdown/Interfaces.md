# Interfaces, what in the world.

This is a guide about interfaces in (unfortunately) java for COMP103. If there
is anything that isn't clear, confused you more, or just needs more
clarification please feel free to ping me on the COMP server or send me a DM.
I'll update the page as needed.

So what are interfaces and what are they used for? The short answer is that
they are a way of ensuring consistent methods between different classes without
worrying about the implementation. If this didn't clear anything up, don't
worry- there's a lot of text left.

I'll also be referring to `ecs100` instead of standard java stuff. Like
`UI.println` instead of `System.out.println` because it's less verbose and also
what most are familiar with.

Also, this page uses JavaScript! Before you click away, it's
[highlightjs](https://highlightjs.org) so that the code blocks have syntax
highlighting :).

[You can find the final code for this guide here.](/guides/samples/Interfaces.java)

## Terms
### Classes and objects

To start with, we need to look at classes (and objects). Interfaces in java are
basically worthless without them. This isn't meant to be a full introduction to
classes, it's just to set the stage.

So- uh- what's the difference between an object and a class? I'll clarify
because I'll use that throughout the guide.

You might see on the interwebs classes being described as the blueprint for
objects, and objects being things built from those blueprints. Here's a more
practical example.

A class is... the code that starts with `class Name {`. So the following is a
class:

```java
class Thing {
    public int field;

    Thing(int num) {
        field = num;
    }

    public int method(int argument) {
        return field + argument;
    }
}
```

And when I do:

```java
Thing thingName = new Thing(57);
```

What is created by `new Thing` and then stored into `thingName` is an object.
The creation of an object is also called instantiation. (You may also see
objects referred to as instances of class, but I won't be saying that here to
avoid confusion)

### Method signatures

This is another term I'll be referring to. It's basically just the name of the
method, with the types and arguments.

So if I have a method that looks like:

```java
void coolStuff(int epicNumber) {
    UI.println("Your number is " + epicNumber);
}
```

The method signature would be this bit:

```java
void coolStuff(int epicNumber)
```

That's all! Here's another example. For this method:

```java
String moreCoolStuff() {
    return "Cool stuff";
}
```

The signature would be:

```java
String moreCoolStuff()
```

## How do you define an interface?

Let's get right into it. Here's how you make one:

```java
interface NameHere {
    void someMethod(int arg);
    int otherMethod();
}
```

It's similar to how you define a class, except that you use the keyword
`interface` instead. The key difference is that the methods are just
signatures! They have nothing in between `{}`. They don't even have the curly
brackets!

That's all an interface is. It's just a named thing with a list of
methods. Pretty funky aye?

## But like, how do you use them?

Let's define a simple interface to do stuff with. I'll call it `Talk` and
list a couple methods. You might have some questions as to *why* use
interfaces, but just bear with me.

```java
interface Talk {
    void speak(String message);
    void yell();
}
```

Okay, very cool, we've got an interface. What now...

Let's say you now want to create a `Talk` variable called `speaker`. You might
try to do something like this:

```java
Talk speaker = new Talk();
```

However, this will **not** compile! You will likely see a message similar to
this:

```
Main.java:3: error: Talk is abstract; cannot be instantiated
    Talk speaker = new Talk();
                   ^
1 error
```

What does this even mean? Well, we can see that the error is where we tried to
create a `new Talk()`. It did not complain about us defining a variable with
the type `Talk`, so that's okay. The important bit of the error is where it
says "Talk is abstract".

In java (and many other languages, for example: C++), something being abstract
basically means that it doesn't have an implementation. In other words, it'll
have a name, but no actual code describing what it actually does! If this
sounds confusing, here's a little example.

A normal method might look like this:

```java
void say(String message)  /* <-- This is the signature */
{                                    /* <--                             */
    UI.println("I say: " + message); /* <--  This is the implementation */
}                                    /* <--                             */
```

So, if we make `say` an abstract method, it'd look like this:

```java
void say(String message);  /* <-- This is the signature */
```

<details>
    <summary>
        A bit more info for the curious (and for the pedants &lt;3)
    </summary>
    Actual abstract methods in java use the `abstract` keyword. So it'd
    actually look like `abstract void say(String message);`, and it'd be part
    of an `abstract class` instead of just a `class`. I chose to skip that to
    avoid throwing out too many things once.
</details>

So, it'd be just the method signature, right? And- hold on- that's exactly what
we put on the interface! That's the reason why we can't just create an object
from an interface, the methods don't have any implementation (code). Java would
not know what to do at all if you called those methods.

Here's the important bit about interfaces, the methods are there so that
classes can implement them- not the interface. A class that implements those
methods (i.e. has methods with the same signatures as the interface) can tell
java that it, in fact, implements the interface. So, if a class implements
`Talk`, java will happily let you put objects of that class into a variable of
type `Talk`.

Worry not, for I have more examples!

Here's the interface again, I copied and pasted it so that you don't have to
scroll up.

```java
interface Talk {
    void speak(String message);
    void yell();
}
```

So, we need to create a class that implements the interface. Let's start by
making a normal class first. I'll make a cat because my cat really likes to
talk. This Cat class will be very simple, it'll just have a name, and it'll
sleep.

```java
class Cat {
    private String name;

    Cat(String name) {
        this.name = name;
    }

    void sleep(int hours) {
        for (int i = 0; i < hours; i++) {
            UI.println("zzzzzzzzzzzzzz");
        }
    }
}
```

Okay! We have a cat now! Let's make it talk! I'll go step by step.

The first thing you'll want to do is to modify the class signature. (It just
means changing `class Cat` to something else). We have to tell java that we'll
be implementing the methods of the `Talk` interface. If we don't, it won't know
what we're trying to do. The change is quite straightforward.

```java
class Cat implements Talk {
    private String name;

    Cat(String name) {
        this.name = name;
    }

    void sleep(int hours) {
        for (int i = 0; i < hours; i++) {
            UI.println("zzzzzzzzzzzzzz");
        }
    }
}
```

Very nice! Something of note is that if we try to compile this as it is now,
java will refuse. Take a look:

```
Cat.java:1: error: Cat is not abstract and does not override abstract method yell() in Talk
class Cat implements Talk {
^
1 error
```

<details>
    <summary>
        Further explanation of the error message
    </summary>
    We can see that it calls `yell` an abstract method. As we saw before,
    methods in interfaces are abstract by default. It also says that Cat is not
    an abstract class (yeah, those are a thing). Therefore, it expects us to
    actually implement those methods.
</details>

This is because we haven't implemented any of the methods listed on the
interface. Java isn't happy that we lied to it about implementing `Talk` :(

Let's create those methods! We'll leave them empty at first just to try it out.
Something of note is that those interface methods **have** to be public. It
makes sense when you think about it, why tell me you have some methods if I
can't use them?

```java
class Cat implements Talk {
    private String name;

    Cat(String name) {
        this.name = name;
    }

    void sleep(int hours) {
        for (int i = 0; i < hours; i++) {
            UI.println("zzzzzzzzzzzzzz");
        }
    }

    public void speak(String message) {

    }

    public void yell() {

    }
}
```

If we try to create a new `Cat` now and put it into a variable of type `Talk`,
you'll find that java is okay with it!

```java
Talk speaker = new Cat("Sparrow Spanner");
```

We implemented the methods that we promised java we would have, so it's happy
to let us do our own thing. Before moving on, let's write some code so that
those methods actually do something.

```java
class Cat implements Talk {
    private String name;

    Cat(String name) {
        this.name = name;
    }

    void sleep(int hours) {
        for (int i = 0; i < hours; i++) {
            UI.println("zzzzzzzzzzzzzz");
        }
    }

    public void speak(String message) {
        UI.println("I am " + name +", I guess. I say: " + message);
    }

    public void yell() {
        UI.println("MRRRAAAAAAAWWW");
    }
}
```

So what can we actually do with this `speaker` variable? Let's try calling some
methods! We'll start by the methods from the interface (`speak` and `yell`).

```java
// Prints: I am Sparrow Spanner, I guess. I say: hi!
speaker.speak("hi!");

// Prints: MRRRAAAAAAAWWW
speaker.yell();
```

Nice! That's what we expected. What if I we try to be sneaky and call a method
that is specific to `Cat`? Let's try and make our cat `sleep` for a couple hours. 

```java
// Sneaky time
speaker.sleep(20);
```

Java is not very happy about our trickery:

```
Cat.java:24: error: cannot find symbol
    speaker.sleep(20);
           ^
  symbol:   method sleep(int)
  location: variable speaker of type Talk
1 error
```

If we break down the error, java is saying that this variable of *type Talk*
doesn't have a method called sleep. And well... this is true. The interface
`Talk` doesn't specify a method called `sleep`. So if a variable is type
`Talk`, then you can only call the methods specified in the interface `Talk`.
It doesn't matter that we put a `Cat` into it, we told java it was a `Talk`, so we can only use `Talk` things.

If we have just one class in a program, the interface doesn't seem that
useful. However they come in handy once you have multiple classes in your
project.

## Many objects !!

Let's make a bunch of classes that implement interface in addition to our `Cat`.
I'll make a `Person` and a `Loudspeaker`. If it helps you to have a context,
imagine we have a file with some info, and we create one of these object
depending on what the file says.

I'll copy and paste the interface code again for reference.

```java
interface Talk {
    void speak(String message);
    void yell();
}
```

This example does mean that I have to make more classes, the code blocks might
seem big but that's just because java is pretty verbose. I won't really explain
the classes, they're pretty simple. However- if you want me to, just send me a
message and I'll add more stuff.

Here's our Person:

```java
class Person implements Talk {
  String firstName;
  String lastName;
  String job;

  Person(String firstName, String lastName, String job) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.job = job;
  }

  // Interface methods
  public void speak(String message) {
    UI.println("Hello I'm " + firstName + " " + lastName + " and I'm the CEO of " + job + ". I say that: " + message);
  }
  public void yell() {
    // We can use our own variables when implementing the method, that's okay!
    UI.println("RAAAAAAAAAAAGGGGGHHHHH, I HATE " + job.toUpperCase());
  }
}
```

Now for the loudspeaker. (It might seem a bit odd to have a `Talk`ing
loudspeaker, but that's just a naming thing. Our interface could instead be
named `MakesNoise` and our methods be called `quiet` and `loud`. It would
function the same way. I just chose `Talk` because easier to read than
`MakeNoise`). Here it is:

```java
class Loudspeaker implements Talk {
  Loudspeaker() {
    // We don't have anything to set up here.
  }

  // Interface methods
  public void speak(String message) {
    UI.println("🎶🎵 " + message + " 🎶🎷");
  }

  public void yell() {
    UI.println("BBBBBBBBBBBBBBBBBBBBBZZZZZZZ");
  }
}
```

You can imagine these classes having other non-interface methods, for example
`Person` could have a method called `writeJava`. I chose not to write them in
to keep it simple, but in your actual code they most likely have a bunch of
non-interface methods... which is okay!

I won't- like- code a loop that reads from a file and creates objects based on
that. That is left as an exercise to the reader ;). I'll just create the
objects manually.

Let's make some of these objects! We'll just have an `ArrayList` with the type
`Talk` to keep track of all of them.

```java
ArrayList<Talk> talkObjects = new ArrayList<>();
// Because all these objects implement Talk, we can put them in the ArrayList
// the same way that we put a Cat into a variable of type Talk earlier
talkObjects.add(new Cat("Missile Launcher"));
talkObjects.add(new Person("John", "Java", "programming"));
talkObjects.add(new Cat("Mabel"));
talkObjects.add(new Loudspeaker());
talkObjects.add(new Person("Ben", "Bacon", "accounting"));
```

This compiles fine! Let's actually use the interface methods. First we'll make
them all speak.

```java
for (Talk speaker: talkObjects) {
    speaker.speak("I love bread");  // I really do
}
```

This will print out the following:

```
I am Missile Launcher, I guess. I say: I love bread
Hello I'm John Java and I'm the CEO of programming. I say that: I love bread
I am Mabel, I guess. I say: I love bread
🎶🎵 I love bread 🎶🎷
Hello I'm Ben Bacon and I'm the CEO of accounting. I say that: I love bread
```

Isn't that cool!! We stored a bunch of different objects on the same ArrayList,
and we called a method on all of them! I hope you can see how this can be
useful on larger programs. Maybe you're making a game with a lot of different
objects and your method for saving the game calls `.save()` on a ton of them.
The possibilities are endless!

Let's try our `yell` method!

```java
for (Talk speaker: talkObjects) {
    speaker.yell();  // Let's be loud!!
}
```

This will print out the following:

```
MRRRAAAAAAAWWW
RAAAAAAAAAAAGGGGGHHHHH, I HATE PROGRAMMING
MRRRAAAAAAAWWW
BBBBBBBBBBBBBBBBBBBBBZZZZZZZ
RAAAAAAAAAAAGGGGGHHHHH, I HATE ACCOUNTING
```

## Final thoughts

Isn't that great. Hopefully by now your brain has expanded to the size of a
bowling ball perhaps a watermelon. If it's not clear I recommend giving it
some time to sink in and then re-reading it a day or so later. If that doesn't
help then feel free to ask on the COMP server and ping me or Ryan (he
volunteered I swear).

Once again, if you want to see it in action or mess with the source code (I
recommend doing this, you really learn a lot by modifying things and seeing
what breaks) you can find it
[on this link here.](/guides/samples/Interfaces.java)

If there's anything that you think needs editing or clarification, send me a DM
and I'll update this guide. If you found it helpful I'd really appreciate a
message about it :), I might write more in the future.

This guide's version is `v1.1`.

<!--
# backburner

When you declare a variable, you're telling java: I want the value of `name` to
have the features of `Class`.

Say like, *why* implement the interface. You could just create the methods,
right? Wronk! You need to tell java explicitly that those methods are part of
the interface. It won't try and guess.

Examples of shapes that can be drawn. Interface Drawable with Draw. Shape
objects like circle, square, triangle.

Why declare something as interface instead of just the object? It's good to declare things with the type that has *just* what you need.

Interfaces can define variables (members) as well, but that's something we'll touch on lecture i think.
-->
