import ecs100.*;
import java.util.ArrayList;

class Interfaces {
  public static void main(String[] args) {
    /* Create our objects */
    ArrayList<Talk> talkObjects = new ArrayList<>();
    // Because all these objects implement Talk, we can put them in the ArrayList
    // the same way that we put a Cat into a variable of type Talk earlier
    talkObjects.add(new Cat("Missile Launcher"));
    talkObjects.add(new Person("John", "Java", "programming"));
    talkObjects.add(new Cat("Mabel"));
    talkObjects.add(new Loudspeaker());
    talkObjects.add(new Person("Ben", "Bacon", "accounting"));

    /* Speak first */
    for (Talk speaker: talkObjects) {
        speaker.speak("I love bread");  // I really do
    }

    /* It's yelling time */
    for (Talk speaker: talkObjects) {
        speaker.yell();  // Let's be loud!!
    }
  }
}

/* The interface we'll be dealing with */
interface Talk {
    void speak(String message);
    void yell();
}

/* The objects that implement it */
// Yes! You can put multiple classes in the same file,
// it does mean that they will only be visible inside
// this file though
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

